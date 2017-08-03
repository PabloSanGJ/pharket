{% if (session.get('investor') != null) %} 
    {% include "partials/home_" ~ session.locale %}

    <div class="row">
        <div class="col-sm-12 table-responsive">        
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo $t->_('currency'); ?></th>
                        <th><?php echo $t->_('quantity'); ?></th>
                        <th><?php echo $t->_('value'); ?> ({{ session.asset }})</th>
                    </tr>
                </thead>
                <tbody>
                    {% for user_asset in user_assets %}
                        <tr>
                            <td>{{ user_asset.translated }}</td>
                            <td>{{ user_asset.quantity }}</td>
                            <td>{{ user_asset.value }}</td>
                        </tr>
                    {% endfor  %}
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>{{ total }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <select id="select_currency" class="form-control" onchange="window.location.replace(document.getElementById('select_currency').value);">
                <option value="/home"><?php echo $t->_('change_default'); ?></option>
                {% for asset in assets %}
                    <option value="/home?asset={{ asset.name }}">{{ asset.translated }}</option>
                {% endfor  %}
            </select>
        </div>
    </div>

    <div class="row" style="margin-top: 40px;">
        <div class="col-sm-12">
            <a class="btn btn-block btn-primary" href="/change"><?php echo $t->_('change_currencies'); ?></a>
        </div>
    </div>

{% else %} 
    <div class="row">
        <div class="col-sm-12 text-left">
            <strong><?php echo $t->_('unauthorised'); ?></strong>  
        </div>
    </div>
{% endif %}
