{{ include('layouts/header.php', {title:'Client Show'})}}

<main class="client-show">
    <div class="client-details">
        <h1 class="client-title">Client Details</h1>
        <div class="client-info">
            <p class="client-info-item"><strong>Name : </strong><span class="client-info-value">{{ client.name }}</span></p>
            <p class="client-info-item"><strong>Address : </strong><span class="client-info-value">{{ client.address }}</span></p>
            <p class="client-info-item"><strong>Phone : </strong><span class="client-info-value">{{ client.phone }}</span></p>
            <p class="client-info-item"><strong>Zip Code : </strong><span class="client-info-value">{{ client.zipcode }}</span></p>
            <p class="client-info-item"><strong>Email : </strong><span class="client-info-value">{{ client.email }}</span></p>
            <p class="client-info-item"><strong>City : </strong><span class="client-info-value">{{ city.name }}</span></p>
        </div>
        {% if session.privilege_id == 1 %}
        <div class="client-actions">
            <a href="{{base}}/client/edit?id={{ client.id }}" class="btn btn-edit">Edit</a>
            <form action="{{base}}/client/delete" method="post" class="delete-form">
                <input type="hidden" name="id" value="{{ client.id }}">
                <button type="submit" class="btn btn-delete">Delete</button>
            </form>
        </div>
        {% endif %}
    </div>
</main>

{{ include('layouts/footer.php')}}
