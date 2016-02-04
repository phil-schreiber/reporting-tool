{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
<div class="col-xs-12">
    	<h1>aktueller Vertrag und Budget</h1>
    </div>    
    
    
    
    <div class="col-xs-12">
        <table>
            <tr>
                <td>Vertragsbeginn: </td>
                <td>{{date('d/m/Y')}}</td>
            </tr>
        </table>
    </div>
</div>
{% endif %}