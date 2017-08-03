{% if (session.get('investor') != null) %} 
    <div id="done" class="alert alert-success" style="display:none;">
        <strong><?php echo $t->_('done'); ?></strong> <?php echo $t->_('successful_message'); ?>
    </div>

    <div id="insufficient" class="alert alert-danger alert-dismissable fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $t->_('hey'); ?></strong> <?php echo $t->_('insufficient_message'); ?>
    </div>

    <div id="error" class="alert alert-danger alert-dismissable fade in" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $t->_('ops'); ?></strong> <?php echo $t->_('unexpected_message'); ?>
    </div>

    {% include "partials/change_" ~ session.locale %}

    <div class="row">
        <div class="col-sm-12 table-responsive">        
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo $t->_('currency'); ?></th>
                        <th><?php echo $t->_('quantity'); ?></th>
                        <th><?php echo $t->_('value'); ?> ({{ session.asset }})</th>
                        <th><?php echo $t->_('quantity_to_buy'); ?></th>
                        <th><?php echo $t->_('buy'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {% for user_asset in user_assets %}
                        <tr>
                            <td>{{ user_asset.translated }}</td>
                            <td>{{ user_asset.quantity }}</td>
                            <td>{{ user_asset.value }}</td>
                            <td>
                                <input id="quantity_{{ user_asset.asset_id }}" type="number" class="form-control" onchange="check({{ user_asset.asset_id }});">
                                <input id="asset_{{ user_asset.asset_id }}" value="{{ user_asset.name }}" type="hidden">
                            </td>
                            <td>
                                <select id="select_currency_{{ user_asset.asset_id }}" class="form-control" onchange="check({{ user_asset.asset_id }});">
                                    <option value=""><?php echo $t->_('select_currency'); ?></option>
                                    {% for asset in assets %}
                                        <option value="{{ asset.name }}">{{ asset.translated }}</option>
                                    {% endfor  %}
                                </select>
                            </td>                          
                            <td>
                                <button id="change_{{ user_asset.asset_id }}" class="btn btn-primary" onclick="change({{ user_asset.asset_id }});" disabled="disabled"><?php echo $t->_('change'); ?></button>
                            </td>
                        </tr>
                    {% endfor %}
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>{{ total }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <select id="change_currency" class="form-control" onchange="window.location.replace(document.getElementById('change_currency').value);">
                <option value="/change"><?php echo $t->_('change_default'); ?></option>
                {% for asset in assets %}
                    <option value="/change?asset={{ asset.name }}">{{ asset.translated }}</option>
                {% endfor  %}
            </select>
        </div>
    </div>

    <script src="/js/change.js"></script>

{% else %} 
    <div class="row">
        <div class="col-sm-12 text-left">
            <strong><?php echo $t->_('unauthorised'); ?></strong>  
        </div>
    </div>
{% endif %}
