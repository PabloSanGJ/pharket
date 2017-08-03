<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Pharket</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {% if (session.get('investor') != null) %} 
                    <a class="navbar-brand" href="/">{{ session.investor.name }}</a>
                    {% else %}
                    <a class="navbar-brand" href="/">Pharket v0.1</a>
                    {% endif %}
                    </div>
                  <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        {% if (session.get('locale') == null or session.get('locale') == "en") %} 
                        <li class="active">
                        {% else %}
                        <li>
                        {% endif %}
                            <a href="/language/en">English</a>
                        </li>
                        {% if (session.get('locale') != null and session.get('locale') == "es") %} 
                        <li class="active">
                        {% else %}
                        <li>
                        {% endif %}
                            <a href="/language/es">Español</a>
                        </li>
                        {% if (session.get('investor') != null) %} 
                            <li><a href="/logout"><?php echo $t->_('logout'); ?></a></li>
                        {% endif %}
                    </ul>
                  </div><!--/.nav-collapse -->
                </div><!--/.container-fluid -->
              </nav>
            
            {{ content() }}
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
