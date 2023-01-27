<?php if (isLoggedIn()) : ?>
    <aside>
        <p class="mainNav__header">Personel</p>
        <ul>
            <li><a href="/restauracja/staff/tables_overview">Obsługa sali</a></li>
            <li><a href="/restauracja/management/order_management">Pogląd na zamówienia - Funkcja Mc'Donalds</a></li>
        </ul>

        <p class="mainNav__header">Zarządzanie</p>
        <ul>
            <li><a href="/restauracja/management/tables_management_overview">Edycja stolików</a></li>
            <li><a href="/restauracja/management/dishes_management">Edycja dań</a></li>
            <li><a href="/restauracja/management/waiter_registration">Rejestracja kelnerów</a></li>
        </ul>
    </aside>

<?php endif; ?>