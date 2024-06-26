import $ from 'jquery'
import '../vendor/datatable'
import { AjaxAction } from '../lib/utils'

$('.main-content').on('click', '.action', function(e) {

    if (!this.dataset.action) {
        throw new Error('data attribute action must provide!');
    }
    
    (new AjaxAction(this))
    .onSuccess(function(res) {
        console.log(res)
    })
    .execute()
})