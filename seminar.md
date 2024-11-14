Here's the updated version with specific instructions for each action:

---

# Injected React into WordPress

## Slides:

### 1. Intro: Injected React into WordPress

### 2. Why Use WordPress
- **Easy/Fast to Launch**: Provides a well-designed, fully functioning CMS, even for E-commerce.
- **Popularity**: Powers around 40% of all websites.
- **Community Support**: Well-documented with a large open-source community.
- **Freelancing Opportunities**: Many small and local businesses use WP, offering freelance opportunities, even in SWFL.
- **Customization**: Highly customizable and extendable to meet business needs.
- **Plugin Marketplace**: Offers easy add-ons for SEO, marketing, and more.

### 3. Why Use React?
- **Modern Framework**: Ideal for state management and complex UI on single pages.
- **Strong Support**: Widely used, with extensive documentation and community support.
- **Career Prospects**: A highly marketable skill for employment.
- **Performance**: Offers excellent performance with various UI and functional libraries.
- **Component-Based**: Flexible architecture for interoperability and DRY code.

### 4. My Experience with React and WordPress
- **Role**: Senior Software Engineer at Real Token (realt.co), the world’s largest real estate investment platform on Ethereum.
- **WordPress Integration**: We use WP as a primary platform for customer services.
- **React Usage**: Integrated with WordPress for complex UIs and features requiring state management.

### 5. Today's Tutorial Outline
1. Set up a local WordPress site using Local by Lightning.
2. Choose a theme for the WP site.
3. Introduce the WP Admin UI (blog, users, etc.).
4. Explore the plugin store.
5. Download the Divi Page Builder.
6. Create a page.
7. Create a custom plugin to inject a React app onto the page.
8. Interact with the WP DB via an Ajax request in the React app using a form update.

---

## Tutorial Instructions and Steps

### Step 1: Install and Create Site
1. **Install Local**:
   - Go to [Local by Lightning](https://localwp.com/) and follow the installation guide.
   - Save sites in an organized path, e.g., `documents/tech/wp_sites`.
2. **Site Setup**:
   - Open Local and click **+ Add Site** to create a new WordPress site.
   - Once created, click **Admin** to open the WordPress Admin dashboard.
   - **Explore the Admin UI**: Navigate through Posts, Pages, Settings, Users, etc., to familiarize yourself with the layout.
   - **View the Site Frontend**: Click **View Site** in Local to open the site’s public view in your browser.
   - **Access the Database**:
     - In Local, click the **DB** button to open Adminer.
     - Use Adminer to view and manage database tables for WordPress.

### Step 2: Explore Plugin Store and Theme Options
1. **Plugins**:
   - In the WordPress Admin, go to **Plugins > Add New**.
   - Search for and install a page builder plugin (e.g., Elementor).
   - Once installed, activate the plugin.
2. **Themes**:
   - Go to **Appearance > Themes > Add New** in the WordPress Admin.
   - Install a theme compatible with Elementor (e.g., News).
   - After installation, click **Activate**.
   - Customize theme options by navigating to **Appearance > Customize**.
3. **Create a Page with Elementor**:
   - Go to **Pages > Add New** in the WordPress Admin.
   - Select **Edit with Elementor** and add a shortcode to the page if desired.
   - (Explain shortcode usage for dynamically embedding content on pages).

### Step 3: Create Our Own Plugin with a React App
1. **Set Up Plugin Template**:
   - Download the [Plugin Template Repo](https://github.com/torrelocascio/wp-plugin-template).
   - Unzip the repo and place it in your wp_repos directory
2. **Gulpfile Setup**:
   - Open the plugin repo folder and locate the `Gulpfile.js`.
   - Modify paths in the Gulpfile to point to your local WP plugin folder, if necessary.
   - Running the Gulpfile commands will bundle and push changes to your plugin folder.
3. **Key Files and Configurations**:
   - **Main.php**: Open `Main.php` and locate where hooks and filters are added. This is the main entry point for plugin functionality.
     - Use `wp_enqueue_scripts` to enqueue additional JavaScript files.
   - **Root Plugin File**: Review versioning and naming in this file. Ensure the version matches the Gulpfile version.
4. **Enqueueing Scripts**:
    - Search for enqueue_public_app_scripts in public/assets
    - You'll see that we are enequeing our React Scripts in the /public/my-app folder which is where our React app will live 
5. **React App Setup**:
   - Navigate to your React app folder and run `npm install`.
   - To start the React app for development, use `npm start`. Run `npm run build` to bundle the app for production.
   - Make sure that the target Id of the React App
6. **Build a Basic Form in React**:
   - Create a simple form component in the React app. Copy and paste from this Repo
   - Set a target ID to connect the form functionality with WordPress.
   - 

-- Now we have a Form in WP, 


### Step 4: Connect the React App To WP and Interact with the WP DB
1. **Create ShortCode Html**
    -Add hook in main.php define_public_module_ajax_hooks --         
    add_shortcode('injected-react', [$module, 'get_injected_frame']); // Also includes sell-tokens frame.
    get_injected_frame add to /public/module-ajax
    - This will now inject this html into the shortcode we had on the page builder (show page)
    - This HTML target ID must match our React App target id
    - Go to page and show HTML and React App Injected

2. **Send Data from DB/WP to front-end with wp_localize_script in public/module-ajax** 
    - find send_user_data_to_front in repo
    - Current user data
    - Nonce
    - Ajax Url
    - Refresh Page and show the CDATA Object in Dom

3. **Digest that data in React into Form and Write Ajax Request** 
    - Explain Form onSubmnit -- e.preventdefault
    - Write FetchWP which is fetch call to WP Server
    - Write getWindowData in utils
    - Call FetchWP with action update_favorite_food_and_drink -- We can connect this action in WP with a hook /public/module-ajax.php
    - 
4. 

---