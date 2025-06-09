<div id="capacityModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Alterar Capacidade</h2>
        <form id="capacityForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="capacidade">Nova capacidade máxima:</label>
                <input type="number" id="capacidade" name="capacidade_maxima" min="1" value="{{ $settings['capacidade_maxima'] }}" required>
            </div>

            <div class="modal-buttons">
                <button type="submit" class="btn-confirm">Confirmar</button>
                <button type="button" class="btn-cancel">Cancelar</button>
            </div>
        </form>
    </div>
</div>
