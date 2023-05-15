document.addEventListener("DOMContentLoaded", function() {
  const submitButton = document.querySelector('button[name="products_by_sap_code"]');
  submitButton.addEventListener("click", async function() {
    const categoryName = document.getElementById('field_title').value;
    const selectedValues = getSelectedValues();
    
    const apiUrl = `https://devcatalog.korzinka.uz/api/ctm/products-by-sap-codes?sap_codes[]=${selectedValues.join('&sap_codes[]=')}`;
    try {
      const data = await makeApiRequest(apiUrl);
      const productsData = data.data.map(product => {
        return { 
          sap_code: product.sap_code, 
          title: product.title,
          product_url: product.product_url,
          price: product.price,
          category: categoryName
        };
      });

      const urli = `http://localhost:8000/api/products-by-sap-codes`;
      const response = await fetch(urli, {
        method: "POST", 
        headers: {
          "Content-Type": "application/json",
        },
        redirect: "follow",
        referrerPolicy: "no-referrer", 
        body: JSON.stringify(productsData), 
      });
      if (response.ok) {
        alert('Products data sent successfully!');
      }
    } catch (error) {
      console.error(error);
    }
  });
});


function getSelectedValues() {
  const selectedSpans = document.querySelectorAll('.vs__selected');
  const selectedValues = [];
  
  selectedSpans.forEach((span) => {
    let spanValue = span.textContent.trim();
    // remove the 'x' mark from the end of the span value
    spanValue = spanValue.replace(/×/g, '');
    spanValue = spanValue.trim();

    selectedValues.push(spanValue);
  });
  
  return selectedValues;
}

function makeApiRequest(endpoint) {
  return fetch(endpoint, {
    headers: {
      'Accept': 'application/json'
    }
  })
  .then(response => response.json());
}
