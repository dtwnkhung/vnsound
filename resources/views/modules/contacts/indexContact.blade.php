
@extends('layouts/contentLayoutMaster')

@section('title', 'Liên hệ')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <style>
    .ql-editor{
      min-height:200px;
    }
  </style>
@endsection
@section('content')
  <div class="card-header border-bottom p-1">
    <!-- Basic toast -->
    <div
            class="toast toast-basic hide position-fixed"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-delay="5000"
            style="top: 1rem; right: 1rem"
    >
      <div class="toast-header">
        <strong class="mr-auto">Thông báo</strong>
        <button type="button" class="ml-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body text-success">{{ session('thongbao') }}</div>
    </div>
    <!-- END Basic toast -->
  </div>
  <table class="table table-bordered" id="users-table">
    <thead>
    <tr>
      <th>Họ và tên</th>
      <th>Email</th>
      <th>Nội dung</th>
      <th>Trạng thái</th>
      <th>Created At</th>
      <th>Updated At</th>
      <th>Thao tác</th>
    </tr>
    </thead>
  </table>
@stop


@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

  <script>
    $(function() {
      $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('contacts.dataContact') !!}',
        columns: [
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'description', name: 'description' },
          { data: 'status', name: 'status' },
          { data: 'created_at', name: 'created_at' },
          { data: 'updated_at', name: 'updated_at' },
          { name: 'actions' },
        ],
        columnDefs: [
          {
            // Actions
            targets: -1,
            title: 'Actions',
            data: 'id',
            orderable: false,
            render: function (data, type, row, meta) {
              var urlEdit = '{{ route("contacts.editContact", ":id") }}';
              urlEdit = urlEdit.replace(':id', row.id);
              var urlDel = '{{ route("contacts.delete", ":id") }}';
              return ('<a href="'+urlEdit+'" class="dropdown-item">' +
                      feather.icons['edit'].toSvg({ class: 'mr-50 font-small-4' }) +
                      'Sửa</a>'
              );
            }
          }
        ],
        order: [[0, 'asc']]
      });
    });
  </script>
  @if (session('thongbao'))
    <script>
      $(document).ready(function(){
        $('.toast-basic').toast('show');
      });
    </script>
  @endif
@endsection