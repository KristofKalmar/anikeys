$(document).ready(function()
{
    const element =
    `<header class="header">
    <div class="headerContentContainer">
      <div class="searchBarContainer">
        <div class="searchBar">
          <input class="searchBarInput" placeholder="Fedezd fel kínálatunkat!"></input>
          <a href="allProducts.html" class="searchButton">
            <object class="searchIcon" data="assets/search.svg"></object>
          </a>
        </div>
      </div>
      <div class="underContainer">
      <a class="headerLogoLink" href="index.html">
        <object class="logo" data="assets/logo.svg"></object>
      </a>
        <div class="headerButtonsContainer">
          <a href="profil.html" class="headerButton">
            <object class="headerButtonIcon" data="assets/user.svg"></object>
          </a>
            <a href="cart.html" class="headerButton">
              <object class="headerButtonIcon" data="assets/cart.svg"></object>
              <div class="headerCartButtonNumberIndicator">
                3
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="linksContainer">
      <a href="allProducts.html" class="linkItem">
        <label class="linkItemText">PC</label>
      </a>
      <a href="allProducts.html" class="linkItem">
        <label class="linkItemText">Playstation</label>
      </a>
      <a href="allProducts.html" class="linkItem">
        <label class="linkItemText">Xbox</label>
      </a>
      <a href="allProducts.html" class="linkItem">
        <label class="linkItemText">Nintendo</label>
      </a>
    </div>
    </header>`;

    $("#header").replaceWith(element);
})