<div class="new-table">
    <table>
        <form method="POST">
            <tr>
                <td>Numer stolika</td>
                <td><input type=" text" name="table_number" required value="<?= $table['table_number'] ?? "" ?>" /></td>
            </tr>
            <tr>
                <td>Liczba miejsc</td>
                <td><input type="number" name="places_count" step="any" required value="<?= $table['places_count'] ?? 0 ?>" /></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Zaktualizuj</button></td>
            </tr>
        </form>
    </table>
</div>