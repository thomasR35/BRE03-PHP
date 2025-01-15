document.addEventListener("DOMContentLoaded", function () {
  const categories = [
    {
      id: 1,
      title: "Technologie",
      description: "Les dernières nouveautés tech",
    },
    { id: 2, title: "Voyage", description: "Destinations incroyables" },
  ];

  const posts = [
    {
      id: 1,
      title: "Les nouvelles innovations en IA",
      content: "Contenu du post sur l'IA...",
    },
    {
      id: 2,
      title: "Voyage à Bali",
      content: "Contenu du post sur le voyage à Bali...",
    },
  ];

  const categoryList = document.getElementById("category-list");
  categories.forEach((category) => {
    const li = document.createElement("li");
    li.textContent = `${category.title}: ${category.description}`;
    categoryList.appendChild(li);
  });

  const postList = document.getElementById("post-list");
  posts.forEach((post) => {
    const li = document.createElement("li");
    li.textContent = post.title;
    postList.appendChild(li);
  });
});
document.addEventListener("DOMContentLoaded", function () {
  fetch("categories.php")
    .then((response) => response.json())
    .then((categories) => {
      const categoryList = document.getElementById("category-list");
      categories.forEach((category) => {
        const li = document.createElement("li");
        li.textContent = `${category.title}: ${category.description}`;
        categoryList.appendChild(li);
      });
    });
});
