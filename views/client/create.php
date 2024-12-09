{{ include('layouts/header.php', {title:'Client Create'})}}

<main class="client-create">
    <div class="form-container">
        <h2 class="form-title">New Client</h2>

        <form method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ inputs.name }}">
                {% if errors.name is defined %}                   
                    <span class="error">{{ errors.name }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ inputs.address }}">
                {% if errors.address is defined %}                   
                    <span class="error">{{ errors.address }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ inputs.phone }}">
                {% if errors.phone is defined %}                   
                    <span class="error">{{ errors.phone }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="zipcode">Zip Code</label>
                <input type="text" id="zipcode" name="zipcode" value="{{ inputs.zipcode }}">
                {% if errors.zipcode is defined %}                   
                    <span class="error">{{ errors.zipcode }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ inputs.email }}">
                {% if errors.email is defined %}                   
                    <span class="error">{{ errors.email }}</span>
                {% endif %}
            </div>

            <div class="form-group">
                <label for="city_id">City</label>
                <select id="city_id" name="city_id">
                    <option value="">Select</option>
                    {% for city in cities %}
                        <option value="{{city.id}}" {% if(city.id == inputs.city_id) %} selected {%endif%}>{{ city.name}}</option>
                    {% endfor %}
                </select>
                {% if errors.city_id is defined %}                   
                    <span class="error">{{ errors.city_id }}</span>
                {% endif %}
            </div>

            <div class="form-submit">
                <input type="submit" class="btn" value="Save">
            </div>
        </form>
    </div>
</main>

{{ include('layouts/footer.php')}}
