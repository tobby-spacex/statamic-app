document.addEventListener("DOMContentLoaded", function() {
    const submitButton = document.querySelector('button[name="products_by_sap_code"]');
    submitButton.addEventListener("click", function() {
        let selectedSpans = document.querySelectorAll('.vs__selected');
        let selectedValues = [];
        
        selectedSpans.forEach((span) => {
          let spanValue = span.textContent.trim();
          // remove the 'x' mark from the end of the span value
          spanValue = spanValue.replace(/×/g, '');
          spanValue = spanValue.trim();

          selectedValues.push(spanValue);
        });
        
     const url = `https://devcatalog.korzinka.uz/api/ctm/products-by-sap-codes?sap_codes[]=${selectedValues.join('&sap_codes[]=')}`;

      let productsData = [];
     // make the API request
     fetch(url, {
       headers: {
         'Accept': 'application/json'
       }
     })
     .then(response => response.json())
     .then(data => {
      productsData = data.data.map(product => {
        return { 
          sap_code: product.sap_code, 
          title: product.title,
          product_url: product.product_url,
          price: product.price
        };
      });
      console.log(productsData);

      const urli = `http://localhost:8000/api/products-by-sap-codes`;
      const response = fetch(urli, {
         method: "POST", 
         headers: {
           "Content-Type": "application/json",
           // 'Content-Type': 'application/x-www-form-urlencoded',
         },
         redirect: "follow",
         referrerPolicy: "no-referrer", 
         body: JSON.stringify(productsData), 
       });

     })
     .catch(error => console.error(error));
    });
  });
