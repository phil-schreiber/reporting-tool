{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<div class="col-xs-12">
    	<h1>Aktueller Vertrag und Budget</h1>
    </div>    
    
    
    
    <div class="col-xs-12">
        <table>            
            <tr>
                <td>Vertragsbeginn: </td>
                <td>{{date('d/m/Y')}}</td>
            </tr>            
        </table>
        <br>
        <table>
            <thead>
                <tr>
                    <th>{{tr('projecttype')}}</th>
                    <th>erbracht</th>
                    <th>insgesamt</th>
                </tr>
            </thead>
            {% for index,spec in specscount %}
            <tr>
                <td>{{spec["title"]}}</td>
                <td style="text-align: center;">
                    {%if arrayKeyExists(index,projectcount) %}
                    {{projectcount[index]}}
                    {% else %}
                    0
                    {% endif %}
                </td>
                <td style="text-align: center;">{{spec["amount"]}}</td>
            </tr>
            {% endfor %}
        </table>
    </div>
</div>
{% endif %}