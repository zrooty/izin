import $ from 'jquery'
import 'datatables.net'
import 'datatables.net-bs5'
import 'datatables.net-responsive'
import 'datatables.net-responsive-bs5'

window['$'] = $

import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'
import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'
import { AjaxAction } from '../lib/utils'



$('.main-content').on('click', '.action', function(e) {
    const el = $(this)
    if (!el.data('action')) {
        throw new Error('data attribute action must provide!');
    }
    
    (new AjaxAction(el))
    .execute()
})