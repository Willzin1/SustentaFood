<div id="cancelModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Cancelar Reserva</h2>
        <form id="cancelForm" action="{{ route('admin.reserva.cancel', ['reserva' => $reserva['id']]) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="motivo">Motivo do cancelamento:</label>
                <textarea id="motivo" name="motivo_cancelamento" rows="4" required></textarea>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn-confirm">Confirmar</button>
                <button type="button" class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </div>
</div>
