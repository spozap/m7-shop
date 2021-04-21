console.log(location.href)
let productId = location.href.split("product_id=")[1]

console.log("ID " + productId)

fetch("../db/getProductInfo.php?product_id="+productId, {
    headers: {
        'Accept': 'application/json'        
    }
}).then(response => 
    response.json()
)
.then(data => {

    console.log("inside")

    let container = document.getElementsByClassName('product-container')[0]

    // SHOW PRODUCT
    let productName = document.createElement('h1')
    productName.innerHTML = "Nombre del producto: " + data.name

    fetch("../db/getNameByUserId.php?id="+data.user_id)
    .then(response => response.json())
    .then(data => {


        console.log("CACA " + data)
        let productOwner = document.createElement('h2')
        productOwner.innerHTML = "Subido por: " + data.name

    });
    
    let productDesc = document.createElement('p')
    productDesc.innerHTML = "Categoría del producto " + data.category

    let price = document.createElement('p')
    price.innerHTML = "Precio del producto " + data.price

    let published = document.createElement('p')
    published.innerHTML = "Producto publicado: " + data.createdAt

    container.append(productName)
    container.append(productDesc)
    container.append(price)
    container.append(published)
})