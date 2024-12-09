{{ include('layouts/header.php', {title:'Edit Client'})}}

<main class="edit-client">
    <div class="form-container">
        <h2 class="form-title">Edit Client</h2>
        <form method="post" class="client-form">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ inputs.name }}" class="form-input">
                {% if errors.name is defined %}
                    <span class="error-message">{{ errors.name }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ inputs.address }}" class="form-input">
                {% if errors.address is defined %}
                    <span class="error-message">{{ errors.address }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ inputs.phone }}" class="form-input">
                {% if errors.phone is defined %}
                    <span class="error-message">{{ errors.phone }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="zipcode">Zip Code</label>
                <input type="text" name="zipcode" id="zipcode" value="{{ inputs.zipcode }}" class="form-input">
                {% if errors.zipcode is defined %}
                    <span class="error-message">{{ errors.zipcode }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ inputs.email }}" class="form-input">
                {% if errors.email is defined %}
                    <span class="error-message">{{ errors.email }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="city_id">City</label>
                <select name="city_id" id="city_id" class="form-input">
                    <option value="">Select</option>
                    {% for city in cities %}
                        <option value="{{ city.id }}" {% if city.id == inputs.city_id %} selected {% endif %}>{{ city.name }}</option>
                    {% endfor %}
                </select>
                {% if errors.city_id is defined %}
                    <span class="error-message">{{ errors.city_id }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-submit" value="Save">
            </div>
        </form>
    </div>
</main>

{{ include('layouts/footer.php')}}
