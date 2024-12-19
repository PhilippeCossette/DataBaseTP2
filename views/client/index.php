{{ include('layouts/header.php', {title:'Clients'})}}

<main class="main-content">
    <h1>Client List</h1>
    <div class="client-cards">
        {% for client in clients %}
            <div class="client-card">
                <h2 class="client-name">
                    <a href="{{base}}/client/show?id={{client.id}}">{{client.name}}</a>
                </h2>
                <p class="client-address">{{client.address}}</p>
                <p class="client-phone">{{client.phone}}</p>
                <p class="client-zipcode">{{client.zipcode}}</p>
                <p class="client-email">{{client.email}}</p>
                <p class="client-city">{{client.city_name}}</p>
            </div>
        {% endfor %}
    </div>
    {% if session.privilege_id == 1 %}
    <div class="new-client-btn">
        <a href="{{base}}/client/create" class="btn">New Client</a>
    </div>
    {% endif %}
</main>

{{ include('layouts/footer.php')}}
