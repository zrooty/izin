import $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, confirmation, HandleFormSubmit, initDatepicker, initSelect2, reloadDataTable, showToast } from '../lib/utils'


$('.main-content').on('click', '[data-action]', function(e) {

    if (this.dataset.method == 'delete') {
        confirmation(res => {
            (new AjaxAction(this))
            .onSuccess(res => {
                showToast(res.status, res.message)
                reloadDataTable('setupaplikasi-table')
            }, false)
            .execute()
        })
        return
    };
    
    (new AjaxAction(this))
    .onSuccess(function(res) {
        initSelect2();
        const handle = (new HandleFormSubmit())
        .onSuccess(res => {

        })
        .reloadDataTable('setupaplikasi-table')
        .init()
    })
    .execute()
})