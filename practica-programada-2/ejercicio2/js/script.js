document.querySelector("#btn").addEventListener("click", () => {

    const frases = [
        "Hello World!",
        "As simple as that!",
        "Just like that!",
        "Easy clap!"
    ];

    const randomIndex = Math.floor(Math.random() * frases.length);
    document.querySelector(".text").textContent = frases[randomIndex];
});