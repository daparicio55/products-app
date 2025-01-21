@props(['route','id','btntext','title'])
<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $id }}">
    <i class="fas fa-trash-alt"></i> {{ $btntext ?? null}}
</button>

<!-- Modal -->
<div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $id }}">
                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $title ?? 'Eliminar' }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: left !important;">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times-circle"></i> Cancelar
                </button>
                <form action="{{ route($route, $id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-check-circle"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>