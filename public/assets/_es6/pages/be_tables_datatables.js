/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pageTablesDatatables {
    /*
     * Init DataTables functionality
     *
     */
    static initDataTables() {
        // Override a few default classes
        jQuery.extend(jQuery.fn.dataTable.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bootstrap4",
            sFilterInput:  "form-control form-control-sm",
            sLengthSelect: "form-control form-control-sm"
        });

        // Override a few defaults
        jQuery.extend(true, jQuery.fn.dataTable.defaults, {
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..",
                info: "Página <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
                paginate: {
                    first: '<i class="fa fa-angle-double-left"></i>',
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: '<i class="fa fa-angle-right"></i>',
                    last: '<i class="fa fa-angle-double-right"></i>'
                }
            }
        });

        // Init full DataTable
        jQuery('.js-dataTable-full').dataTable({
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20,50], [5, 10, 15, 20,50]],
            autoWidth: false
        });

        // Init full extra DataTable
        jQuery('.js-dataTable-full-pagination').DataTable({
            pagingType: "full_numbers",
            "processing": true,
            responsive: true,
            pageLength: 10,
            buttons: [
                { extend: 'copy', className: 'btn btn-sm btn-primary' },
                { extend: 'csv', className: 'btn btn-sm btn-primary' },
                { extend: 'print', className: 'btn btn-sm btn-primary' }
            ],
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            }
        });

        // Init simple DataTable
        jQuery('.js-dataTable-simple').DataTable({
            pageLength: 10,
            lengthMenu: false,
            searching: false,
            autoWidth: false,
            dom: "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>"
        });

        // Init DataTable with Buttons
        jQuery('.js-dataTable-buttons').dataTable({
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            buttons: [
                { extend: 'copy', className: 'btn btn-sm btn-primary' },
                { extend: 'csv', className: 'btn btn-sm btn-primary' },
                { extend: 'print', className: 'btn btn-sm btn-primary' }
            ],
            dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initDataTables();
    }
}

// Initialize when page loads
jQuery(() => { pageTablesDatatables.init(); });
