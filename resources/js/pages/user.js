import $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction, HandleFormSubmit, initDatepicker } from '../lib/utils'

$('.main-content').on('click', '.action', function(e) {

    if (!this.dataset.action) {
        throw new Error('data attribute action must provide!')
    }
    
    (new AjaxAction(this))
    .onSuccess(function(res) {
        initDatepicker();

        $('.add-atasan').on('click',  function() {
            (new AjaxAction(this))
            .onSuccess(res => {
                const modalEl = $('#modalSearch')
                modalEl.html(res)
                modalEl.modal('show');
                
                $('#listatasan-table').on('click', 'tr', function() {
                    modalEl.modal('hide')

                    const atasan = `<tr>
                    <td>${this.dataset.nama}</td>
                    <td>${this.dataset.email}</td>
                    <td><input class="form-control" placeholder="Level atasan" name="atasan[${this.dataset.id}]"/>
                    </tr>`

                    $('#listAtasan').prepend(atasan)
                });
            },false)
            .execute();
        });

        (new HandleFormSubmit())
        .onSuccess(res => {

        })
        .reloadDataTable('user-table')
        .init()
    })
    .execute()
})