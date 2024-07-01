import $ from 'jquery'


const modalEl = $('#modalAction')

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
                        //defa
                    }

                    _this.successCb && _this.successCb(res)
                },
                error: err => {
                    if (_this.runDefaultErrorCb) {

                    }

                    _this.errorCb && _this.errorCb(err)
                },
                complete: () => {
                    _this.button.attr('disabled', false).html(_this.buttonLabel)
                }
            })
        })
    }
}