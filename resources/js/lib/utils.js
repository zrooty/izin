import iziToast from 'izitoast'
import $ from 'jquery'
import 'izitoast/dist/css/izitoast.min.css'
import 'bootstrap-datepicker'
import 'bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'
import Swal from  'sweetalert2'
// import 'sweetalert2/src/sweetalert2.scss'

const modalEl = $('#modalAction')

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name=csrf_token]').attr('content')
    }
})

export function reloadDataTable(id) {
    window.LaravelDataTables[id]?.ajax.reload(null, false)
}

export function confirmation(cb, configs = {}) 
{
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        ...configs
      }).then((result) => {
        if (result.isConfirmed) {
          cb && cb(result)
        }
      });
}

export function initDatepicker(selector = '.date', options = {}) {
    const date = $(selector).datepicker({
        autoclose: true,
        todayHighlight: true,
        ...options
    })

    return date
}

export function showToast(type = 'success', message = 'Berhasil menyimpan data'){
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
            method: this.el.data('method') ?? 'get',
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
    datatableId = null
    constructor(formId = '#formAction'){
        super()
        this.formId = $(formId)
        this.button = this.formId.find('button[type="submit"]')
        this.buttonLabel = this.button.html()

    }

    reloadDataTable(id){
        this.datatableId = id
        return this
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
                    showToast(res?.status)
                    _this.successCb && _this.successCb(res)
                    if (_this.datatableId){
                        window.LaravelDataTables[_this.datatableId].ajax.reload(null, false)
                    }
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