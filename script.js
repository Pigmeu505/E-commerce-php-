const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login')

registerBtn.addEventListener('click', () =>{
    container.classList.add("active");
});

loginBtn.addEventListener('click', () =>{
    
    container.classList.remove("active");
});

// Inicializa o carrinho no localStorage, caso não exista
const cart = JSON.parse(localStorage.getItem("cart")) || [];
localStorage.setItem("cart", JSON.stringify(cart));

// Função para adicionar produtos ao carrinho
const addToCart = (product) => {
    const existingProduct = cart.find((item) => item.id === product.id);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ ...product, quantity: 1 });
    }

    // Atualiza o localStorage
    localStorage.setItem("cart", JSON.stringify(cart));

    // Alerta ao usuário
    alert(`${product.name} foi adicionado ao carrinho!`);
};

// Evento de clique nos botões "Add to Cart"
document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", () => {
        const product = {
            id: button.dataset.id,
            name: button.dataset.name,
            price: parseFloat(button.dataset.price),
            image: button.dataset.image,
        };

        addToCart(product);

        // Redireciona para a página do carrinho
        window.location.href = "./carrinho.html";
    });
});
