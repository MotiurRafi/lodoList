<header class="header" id="header">
    <div class="logo" id="logo"><a href="/todoList"><img src="img/logo2.png" alt=""></a></div>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <!-- <div class="search">
                <form action="">
                    <input type="text">
                    <button type="submit"><span><i class="fa-solid fa-magnifying-glass"></i></span></button>
                </form>
            </div> -->
    <?php
    // Start the session

    // Get the current URL
    $currentURL = $_SERVER['REQUEST_URI'];

    if (strpos($currentURL, 'profile') === false) {
        echo '<div class="sign_box">';

        if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
            echo '<a href="/todoList/profile" class="profile" id="profile"><i class="fa-regular fa-user"></i></a>';
        } else {
            echo '<a href="/todoList/signup" class="sign_up" id="sign_up">SignUp</a>';
        }

        echo '</div>';
    }
    ?>


</header>
<style>
    .header {
        display: flex;
        align-items: center;
        position: fixed;
        top: -85px;
        backdrop-filter: blur(3px);
        background-color: rgba(185, 71, 255, 0.4);
        width: -webkit-fill-available;
        z-index: 10;
        margin: 1rem 5%;
        padding: 0 1rem;
        border-radius: 1rem;
        border: 1px solid var(--first-color-opacity);
        box-shadow: 0 0 10px 0 var(--first-color-opacity);
        transition: .5s ease;
        <?php
        if (strpos($currentURL, 'profile') === false) {
            echo 'justify-content: space-between;';
        }
        ?>
    }

    .header .logo {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header .logo img {
        height: 4rem;
    }

    .header nav {
        margin: 0 0 0 30rem;
        <?php
        if (strpos($currentURL, 'profile') === false) {
            echo 'margin: 0 0 0 -40rem;';
        }
        ?>
    }

    .header nav ul {
        display: flex;
        gap: 4rem;
    }

    .header nav ul li {}

    .header nav ul li a {
        color: white;
        position: relative;
        transition: .2s ease;
        text-transform: uppercase;
    }

    .header nav ul li a::before {
        content: '';
        position: absolute;
        bottom: -.3rem;
        left: 0;
        width: 0%;
        height: 2px;
        background: linear-gradient(90deg, var(--first-color), var(--sec-color));
        transition: .2s ease;

    }

    .header nav ul li a:hover {
        color: var(--sec-color);
    }

    .header nav ul li a:hover::before {
        width: 120%;
    }

    /*  .header .search {
    border: 1px solid #fff;
    border-radius: .5rem;
}

.wrapper .header .search form {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: .5rem 1rem;
    gap: 1rem;
}

.wrapper .header .search form input {
    background: none;
    outline: none;
    border: none;
    color: #fff;

}

.wrapper .header .search button {
    background: none;
    color: #fff;
    border: none;
} */

    .header .sign_box {
        justify-self: end;
    }

    .header .sign_box .sign_up {
        color: #fff;
        background-color: transparent;
        border: 1px solid var(--sec-color);
        outline: none;
        padding: .3rem 1rem;
        border-radius: .5rem;
        font-size: 1rem;
        transition: .2s ease;
    }

    .profile {
        border: 1px solid var(--sec-color);
        color: #fff;
        padding: 0.5rem .8rem;
        border-radius: 0.5rem;
        margin: 0 0.5rem 0 0;
        transition: .2s ease;
    }

    .profile:hover,
    .header .sign_box .sign_up:hover {
        background: linear-gradient(90deg, var(--first-color), var(--sec-color));
    }
</style>