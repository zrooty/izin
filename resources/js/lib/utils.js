import $ from 'jquery'


const modalEl = $('#modalAction')

export class AjaxAction {

    constructor(el) {
        this.el = el
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
                modalEl.html(res)
                modalEl.modal('show')
            },
            error : err => {

            },
            complete: () => {
                this.el.attr('disabled', false)
                this.el.html(this.label)
            }
        })
    }
}