@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">{{ $title }} <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">{{ $sub_title }}</h5>

    <div class="mt-4">
        {!! $dataTable->table([], true) !!}
    </div>
</div>

@push('scripts')
<script src="https://cdn.datatables.net/plug-ins/1.10.11/sorting/date-eu.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.bootstrap4.min.css">
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
<style>
    tfoot {
        display: table-header-group;
    }
</style>
{!! $dataTable->scripts() !!}
@endpush
@endsection
