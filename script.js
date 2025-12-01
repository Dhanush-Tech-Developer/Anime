// Get genre from URL
function getGenreFromURL() {
  const params = new URLSearchParams(window.location.search);
  return params.get("genre");
}

fetch("getAnime.php")
  .then((res) => res.json())
  .then((data) => {
    const container = document.getElementById("animeList");
    const selectedGenre = getGenreFromURL();

    data.forEach((anime) => {
      // Filter by genre if selected
      if (
        !selectedGenre ||
        anime.genre.toLowerCase() === selectedGenre.toLowerCase()
      ) {
        container.innerHTML += `
                <div class="anime-card" data-title="${
                  anime.title
                }" data-genre="${anime.genre}">
                    <img src="${anime.image_url}" alt="${anime.title}">
                    <h3>${anime.title}</h3>
                    <p>${anime.genre}</p>
                    <p>${anime.description.substring(0, 100)}...</p>
                    <a class="btn" href="anime_details.html?id=${
                      anime.id
                    }">View Details</a>
                </div>
            `;
      }
    });

    // If a genre filter is active, update the search box
    if (selectedGenre) {
      document.getElementById("searchInput").value = selectedGenre;
    }
  });

// Optional: preserve search box functionality
document.getElementById("searchInput").addEventListener("keyup", function () {
  let filter = this.value.toLowerCase();
  let cards = document.querySelectorAll(".anime-card");
  cards.forEach((card) => {
    let title = card.dataset.title.toLowerCase();
    let genre = card.dataset.genre.toLowerCase();
    if (title.includes(filter) || genre.includes(filter)) {
      card.style.display = "block";
    } else {
      card.style.display = "none";
    }
  });
});

// Optional: Clickable genre cards
document.querySelectorAll(".genre-card").forEach((card) => {
  card.addEventListener("click", () => {
    const genre = card.getAttribute("data-genre");
    window.location.href = `anime.html?genre=${genre}`;
  });
});
