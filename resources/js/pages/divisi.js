import $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, confirmation, HandleFormSubmit, initDatepicker, reloadDataTable, showToast } from '../lib/utils'

$('.main-content').on('click', '.action-delete', function(e) {
    confirmation(res => {
        (new AjaxAction(this))
        .onSuccess(res => {
            showToast(res.status, res.message)
            reloadDataTable('divisi-table')
        }, false)
        .execute()
    })
})

$('.main-content').on('click', '.action', function(e) {

    if (!this.dataset.action) {
        throw new Error('data attribute action must provide!')
    }
    
    (new AjaxAction(this))
    .onSuccess(function(res) {

        const handle = (new HandleFormSubmit())
        .onSuccess(res => {

        })
        .reloadDataTable('divisi-table')
        .init()
    })
    .execute()
})