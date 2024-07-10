import $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, confirmation, HandleFormSubmit, initDatepicker, reloadDataTable, showToast } from '../lib/utils'

// $('.main-content').on('click', '.action-delete', function(e) {
//     confirmation(res => {
//         (new AjaxAction(this))
//         .onSuccess(res => {
//             showToast(res.status, res.message)
//             reloadDataTable('cutitahunan-table')
//         }, false)
//         .execute()
//     })
// })

$('.main-content').on('click', '[data-action]', function(e) {

    if (this.dataset.method == 'delete') {
        confirmation(res => {
            (new AjaxAction(this))
            .onSuccess(res => {
                showToast(res.status, res.message)
                reloadDataTable('cutitahunan-table')
            }, false)
            .execute()
        })
        return
    };
    
    (new AjaxAction(this))
    .onSuccess(function(res) {
        initDatepicker('.date', {
            minViewMode: 2,
            format: 'yyyy',
        })

        $('#user_name').on('click', function(e) {
            const _this = this;
            const action = (new AjaxAction(this))
            .onSuccess(res => {
                const modalEl = $('#modalSearch')
                modalEl.html(res)
                modalEl.modal('show');
                
                $('#listatasan-table').on('click', 'tr', function() {
                    modalEl.modal('hide')
                    _this.value = this.dataset.nama
                    $('[name=user_id]').val(this.dataset.id)
                });
            },false)
            .execute()
        })

        const handle = (new HandleFormSubmit())
        .onSuccess(res => {
        })
        .reloadDataTable('cutitahunan-table')
        .init()
    })
    .execute()
})