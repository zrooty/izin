import $ from 'jquery'


const modalEl = $('#modalAction')

export class AjaxAction {
    successCb = null
    runDefaultSuccessCb = true
    errorCb = null
    runDefaultErrorCb = true


    constructor(el) {
        this.el = $(el)
        this.label = this.el.html()
    }

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