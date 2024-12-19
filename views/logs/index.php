{{ include('layouts/header.php', {title: 'Logs'}) }}

<main class="main-content">
    <h1>Log Entries</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Username</th>
                <th>Visited Page</th>
                <th>Visit Date</th>
            </tr>
        </thead>
        <tbody>
            {% for log in logs %}
            <tr>
                <td>{{ log.id }}</td>
                <td>{{ log.ip_address }}</td>
                <td>{{ log.username }}</td>
                <td>{{ log.visited_page }}</td>
                <td>{{ log.visit_date }}</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
</main>

{{ include('layouts/footer.php') }}
