import iziToast from 'izitoast'
import $ from 'jquery'
import 'izitoast/dist/css/izitoast.min.css'


const modalEl = $('#modalAction')

export function showToast(type = 'success', message = 'Berhasil menyimpaan data'){
    // console.log(message)
    iziToast[type]({
        title: 'Info',
        message,
        position: 'topRight'
    })
}
class AjaxOption{
    successCb = null
    runDefaultSuccessCb = true
    errorCb = null
    runDefaultErrorCb = true

    onSuccess(cb, runDefault = true) {
        this.successCb = cb
        this.runDefaultSuccessCb = runDefault
        return this
    }

    onError(cb, runDefault = true) {
        this.errorCb = cb
        this.runDefaultErrorCb = runDefault
        return this
    }
}
export class AjaxAction extends AjaxOption {
    constructor(el) {
        super()
        this.el = $(el)
        this.label = this.el.html()
    }

    execute() {
        $.ajax({
            url: this.el.data('action'),
            beforeSend: () => {
                this.el.attr('disabled', true)
                this.el.html('Loading...')
            },
            success: res => {
                if (this.runDefaultSuccessCb){
                    modalEl.html(res)
                    modalEl.modal('show')

                }
                
                this.successCb && this.successCb(res)
            },
            error : err => {
                if(this.runDefaultErrorCb){

                }
                this.errorCb && this.errorCb(err)
            },
            complete: () => {
                this.el.attr('disabled', false)
                this.el.html(this.label)
            }
        })
    }
}

export class HandleFormSubmit extends AjaxOption {
    constructor(formId = '#formAction'){
        super()
        this.formId = $(formId)
        this.button = this.formId.find('button[type="submit"]')
        this.buttonLabel = this.button.html()

    }

    init(){
        const _this = this
        this.formId.on('submit', function(e){
            e.preventDefault()

            $.ajax({
                url: _this.formId.attr('action'),
                method: _this.formId.attr('method'),
                data: new FormData(this),
                processData: false,
                contentType: false, 
                beforeSend: () => {
                    _this.button.attr('disabled', true).html('Loading...')
                },
                success: res => {
                    if (_this.runDefaultSuccessCb) {
                        modalEl.modal('hide')
                        
                    }
                    showToast(res?.message)
                    _this.successCb && _this.successCb(res)
                },
                error: err => {
                    if (_this.runDefaultErrorCb) {
                        $('.is-invalid').removeClass('is-invalid')
                        $('.invalid-feedback').remove()
                        const message = err.responseJSON?.message
                        const errors =err.responseJSON?.errors

                        showToast('error', message)
                        if (errors){
                            let i =0
                            for (let [key, value] of Object.entries(errors)){
                                const input =$(`[name="${key}"]`)
                                if (i==0){
                                    input.focus()
                                }
                                // console.log(key, value)
                                input.addClass('is-invalid').parents('.form-wrapper').append(`<div class="invalid-feedback">${value}</div>`)
                                i++;
                            }
                        }
                    }
                    _this.errorCb && _this.errorCb(err)
                    _this.button.attr('disabled', false).html(_this.buttonLabel)
                },
                complete: () => {
                    _this.button.attr('disabled', false).html(_this.buttonLabel)
                }
            })
        })
    }
}