{% include "partials/index_" ~ session.locale %}

{% if (session.get('investor') == null) %} 
    <div class="row">
        {% for user in users %}
            <div class="col-sm-3">
                <a class="btn btn-block {{ user.class }}" href="/home?user_id={{ user.id }}">{{ user.name }}</a>
            </div>
        {% endfor  %}
    </div>
{% else %} 
    <div class="row">
        <div class="col-sm-12 text-center">
            <a class="btn btn-lg btn-default" href="/home"><?php echo $t->_('come_on_in'); ?></a>
        </div>
    </div>
{% endif %}