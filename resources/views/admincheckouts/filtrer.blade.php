<form action="{{ route('admin.checkouts.index') }}" method="GET">
    <select name="status" class="form-select" onchange="this.form.submit()">
        <option value="">Tous</option>
        <option value="Pending">En attente</option>
        <option value="In progress">En cours</option>
        <option value="Delivered">Livrées</option>
        <option value="Canceled">Annulées</option>
    </select>
</form>
