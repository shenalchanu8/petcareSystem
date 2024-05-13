let lable = document.getElementById('lable');
let shoppingCart = document.getElementById('shopping-cart');



let basket = JSON.parse(localStorage.getItem("data")) || [];



let calculation =()=> {
    let cartIcon = document.getElementById("cartAmount");
    cartIcon.innerHTML = basket.map((x) => x.item).reduce((x, y)=> x + y, 0);
    
};

calculation();

let generateCartItem = ()=>{
    if(basket.length !==0){
        return (shoppingCart.innerHTML = basket
            .map((x)=>{
            
            let {id, item} = x;
            let search = shopItemsData.find((y)=> y.id === id) || [];
            return `
            <div class="cart-item">

            <img width="100" src=${search.img} alt=""/>

            <div class="details">

            <div class="title-price-x">
            <h4 class="title-price">
                <p>${search.name}</p>
                <p class="cart-item-price">$ ${search.price}</p>

            </h4>
                <i onclick="removeItem(${id})" class="bi bi-x-lg"></i>
            </div>

            <div class="buttons">
                <i onclick="decrement(${id})" class="bi bi-dash-lg"></i>
                <div id=${id} class="quantity"> ${item}</div>
                <i onclick="increment(${id})" class="bi bi-plus-lg"></i>
            </div>

            <h3>
            $ ${item * search.price}
            </h3>
            </div>
            </div>
            
            `;
        })
           .join(""));
    }
    else{
        shoppingCart.innerHTML = ``;
        lable.innerHTML = `
        <h2>Cart is empty</h2>
        <a href="cart.html">
        <button class="HomeBtn">Back to Home</button>
        </a>
        `;
    }
};


generateCartItem();

let increment = (id) => {
    let selectedItem = id;
    let search = basket.find((x) => x.id === selectedItem.id);
    if (search === undefined){
        basket.push({
            id:selectedItem.id,
            item: 1,
        });

    }
    else {
        search.item +=1;
    }
  
    
    generateCartItem();
    update(selectedItem.id);
    localStorage.setItem("data", JSON.stringify(basket));

};
let decrement = (id) => {
    let selectedItem = id;
    let search = basket.find((x) => x.id === selectedItem.id);

    if (search === undefined)return;

    else if (search.item === 0) return;

    else {
        search.item -=1;
    }
  
    update(selectedItem.id);
    basket = basket.filter ((x) => x.item !== 0);
    generateCartItem();
   
    localStorage.setItem("data", JSON.stringify(basket));
};

let update = (id) => {
    let search = basket.find((x)=>x.id === id)
    document.getElementById(id).innerHTML = search.item;
    calculation();
    TotalAmount();
};

let removeItem = (id) => {
    let selectedItem = id
    basket = basket.filter((x)=>x.id !== selectedItem.id );
    generateCartItem();
    TotalAmount();
    localStorage.setItem("data", JSON.stringify(basket));
};

let clearcart = (id) =>{
    basket=[]
    generateCartItem();
    localStorage.setItem("data", JSON.stringify(basket));

}

let TotalAmount = ()=>{
    if(basket.length !==0){
        let amount = basket.map((x)=>{
            let {item, id} = x;
            let search = shopItemsData.find((y)=> y.id === id) || [];

            return item * search.price;
        })
        .reduce((x, y)=> x + y ,0);
        lable.innerHTML =`
        <h2>Total Bill:$ ${amount}</h2>
        <a href = "payment.html"><button class="checkout">checkOut</button></a>
        <button onclick="clearcart()" class="removeAll">Clear Cart </button>
`;

    } else return;

};


TotalAmount();