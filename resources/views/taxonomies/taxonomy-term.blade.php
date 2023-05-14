<form method = "POST" action = "{{route('sap_codes.store')}}">
    @csrf
    <h3>you are on the Category {{$title}} page</h3>

    <p>Create new product with Sap codes</p>

    <input type="text" name="category" value="{{$title}}" hidden>
    <label for="sap-codes">Product name:</label><br/>
    <input type="text" name="name" value=""><br/>
    
    <label for="sap-codes">SAP Codes:</label><br/>
    <input type="text" name="sap_codes[]" value=""><br/>
    <input type="text" name="sap_codes[]" value=""><br/>
    <input type="text" name="sap_codes[]" value="">


    <button type="submit">Send</button>
</form>
