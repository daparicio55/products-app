@props(['id','thead','tbody','tfoot'=>null])
<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            {{ $thead }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
        @if($tfoot)
            <tfoot>
                {{ $tfoot }}
            </tfoot>
        @endif
    </table>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#{{ $id }}').DataTable();
        });
    </script>
@endpush