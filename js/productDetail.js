console.log(location.href)
let productId = location.href.split("product_id=")[1]

console.log("ID " + productId)

fetch("../db/getProductInfo.php?product_id="+productId , {
}).then(response => response.json())
.then(data => {
    console.log("DATA " + JSON.stringify(data))

    let container = document.getElementsByClassName('product-container')[0]

    // SHOW PRODUCT
    let productName = document.createElement('h1')
    productName.innerHTML = data.name

    let productOwner = document.createElement('h2')
    productOwner.innerHTML = data.user_id

    let productDesc = document.createElement('p')
    productDesc.innerHTML = data.category

    let price = document.createElement('p')
    price.innerHTML = data.price

    let published = document.createElement('p')
    published.innerHTML = data.createdAt

    container.append(productName)
    container.append(productOwner)
    container.append(productDesc)
    container.append(price)
    container.append(published)
})