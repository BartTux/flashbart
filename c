[33mcommit 1a3a2e7644baa894fd90d3e15dea6d703d3af8bb[m[33m ([m[1;36mHEAD -> [m[1;32mmaster[m[33m, [m[1;31morigin/master[m[33m)[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Thu Nov 21 09:53:33 2019 +0100

    Customise tme main page heading form
    
    Divide field rows to particular parts such as widget and label.
    Add attributes and class to these parts. Optimise the whole form
    with Twig functions.
    
    Change the name of example_sentence variable to exampleSentence so that
    all the variables name are written by camelCase convention.

[33mcommit 3ec7c98823abe40aafe419796e09ad6157d039cd[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Wed Nov 20 10:56:09 2019 +0100

    Start customise the main page heading form

[33mcommit 9be85d7ef343cb8a1166ecb4c0fdac096c0ea4a2[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Tue Nov 19 10:16:27 2019 +0100

    Add new form types to main page form
    
    Modify form code inside FlashcardController (now inside
    Form\FlashcardType) by adding select drop-down that is responsible for
    sorting flashcards by particular option. Also add submit button to
    submit the whole form. Both of these are serve by Symfony Form `add()`
    method and Symfony Form Type parameters.
    
    Move the whole form code to Form\FlashcardType class because it's good
    practice.

[33mcommit fd804233e08f1e04a0b0f6899f2b451463abc2b8[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Wed Nov 13 10:25:48 2019 +0100

    Install Symfony Form and create trial form
    
    Install symfony/form package by Symfony Flex. Create trial form
    inside FlashcardController (also to a test) by createFormBuilder()
    method provided by Symfony Form. The above method serves Doctrine
    Flashcards entity (flashcards table in database). Create checkbox to
    serve `example_sentence` field (which is placed inside Flsahcards entity)
    and the other checkbox to serve `pronunciation` field (also placed
    inside Flashcards entity). Return complete form to the template by
    createView() method.
    
    Remove original form HTML code inside base.html.twig template and move
    it to the main.html.twig template. That's because each page will have
    a different type of form. Comment form HTML code (make it to preview
    only) and replace it with form Twig function that displays controller's
    form code (created by createFormBuilder()) described above.

[33mcommit 2310ff25aed090661851b36fcba1c3be8ba2d921[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Tue Nov 12 10:27:55 2019 +0100

    Write a service to restore and remove from trash
    
    Create deleteOneFromTrashById() and deleteOneById() methods in
    TrashRepository and the queries inside them to delete record from Trash
    and Flashcards entry by given flashcard id. deleteOneById() must
    execute both of these methods (deleteOneFromTrashById() and then
    deleteOneById()) to avoid the errors regarding relations and foreign
    keys.
    
    Write restoreDeletedFlashcard() and removeDeletedFlashcard() actions
    inside the TrashController which execute described above methods from
    TrashRepository. Also pass a particullar flashcard id to
    TrashRepository methods. Return redirecting to main trash page.
    Also modify route names and update in every file which use them.
    
    Modify a little the styles. For choosen `Flashcard` subpage replace the
    blue background on bold font. Inside the `Trash` page make the
    flashcards tranparent by default.

[33mcommit c9421b05901219ba5a37042ec2b3d63fbcaad54c[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Mon Nov 11 13:30:43 2019 +0100

    Start creating flashcards removing service
    
    Add new 'Trash' Entity where there are stored deleted flashcards.
    Modify queries in FlashcardsRepository with Doctrine to get the
    flashcards which are not in Trash. Create new queries inside
    TrashRepository to get flashcards deleted by user. Add TrashController
    and modify annotations.yaml file to avoid routes name collisions.
    
    Modify base and main Twig templates. Add new trash template and
    modify its styles.

[33mcommit d060bd7944a20c7d872f331f488fa5ff177b068d[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Fri Nov 8 10:22:04 2019 +0100

    Refactor sidebar categories list display service
    
    Create CategoryController and move action from FlashcardController
    there. Also move for loop responsible for display categories list
    inside the sidebar to new created 'categories_list' template. Use
    Twig render method inside base file (place where the loop were) to
    display all categories once on every page.
    
    Create deleteFlashcard action inside FlashcardController. Start adding
    parameters and writing DocBlocks. Write todos for the future.

[33mcommit 8ec49667a9405690910767c850a44ad06cc1df77[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Thu Nov 7 09:26:00 2019 +0100

    Work with dynamic data from database
    
    Install Doctrine and create entities for tables in database.
    Get needed records from database by Doctrine and modify
    FlashcardController's methods to work with Doctrine.
    
    Write findAllByCategory method by query builder inside
    FlashcardsRepository to get flashcards that they have proper category
    given by particular route.
    
    Modify Twig code inside base and main Twig files.

[33mcommit 08459584fc21502f83c8267bc2e4a5d942304971[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Thu Oct 3 10:28:54 2019 +0200

    Change static categories to dynamic

[33mcommit 63c994df0f38f2feb51c2aa23a6f215eacf10247[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Wed Oct 2 10:30:24 2019 +0200

    Config the routes of every Controller action

[33mcommit 036b12934d3fafd6a0ec1fce94dc43daea2d8919[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Tue Oct 1 10:18:16 2019 +0200

    Add "show a word translation" function
    
    Add FlashcardController::showFlashcardTranslation method inside the
    FlashcardController that takes a id parameter which is a number of
    the choosen card. Write the route for this function.
    
    Inside the main twig template (main.html.twig) modify the code by
    adding condition which check if id of a card exist in URI (id exists
    when user choose some card or when write the URI with that id by
    oneself). If YES - display only translation of specific flashcard and
    display the rest of the cards by default (foreign word + pronunciation
    and example sentence if choosen in top bar), If NO - display everything
    by default.
    
    Move CSS styles for flashcards to another file (_flashcard.scss) and
    directory (/css/components) and modify the min height for card.

[33mcommit 54ab0e2d9fe512f448e6b02575f44b7381903e0d[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Mon Sep 30 10:24:05 2019 +0200

    Supplement flashcard's controller with static data
    
    Write an array contain static data (data from database in future)
    inside main controller's FlashcardController::showFlashcards() method.
    Also modify mainpage twig template by adding twig functions that decide
    which data from controller should be show on the page.
    
    Install annotations package that allows to write a routes inside the
    annotations above the controller methods. Remove YAML routes and
    replace their with annotation routes.
    
    Also modify a bit the heading styles by adding a cursor pointer style
    for checkboxes in "Show" group.

[33mcommit d7ac59ff7cb1523904ae25e201e3f3ed6a4e813b[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Sat Sep 28 16:21:27 2019 +0200

    Create the flashcard prototype
    
    Write HTML code for flashcard template and put inside a placeholder
    content temporarily (not default) so that check card's and its content
    appearance before start creating controller to serve flashcard's data.
    
    Style the flashcard structure with Bootstrap classes and add custom CSS
    to change some Bootstrap default styles where this is required by
    app wireframe.

[33mcommit bae89f2ad131fdb8b53f519076a09e7bf33e20fd[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Fri Sep 27 15:35:22 2019 +0200

    Finish styling the horizontal navigation bar
    
    Replace Bootstrap default styles to custom and edit or remove some kind
    of browser's elements default styles. Make the changed elements more
    accessible.
    
    Refactor a little bit the header HTML structure and clean the internal
    code.

[33mcommit 1d53ec527ba8a8b7621bc4c0a6a2f193fc3b56b7[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Thu Sep 26 15:47:49 2019 +0200

    Stylize header and horizontal navigation

[33mcommit 24911c83d9724a939f4d793454451c9c84f9770d[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Thu Sep 26 11:14:32 2019 +0200

    Create horizontal navigation structure

[33mcommit b380445999e4a37324b46aff1d4b3221c8fb9e76[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Wed Sep 25 09:08:11 2019 +0200

    Refactor sidebar and make flexible all elements
    
    Modify and reduce count of custom styles for the whole side. Add some
    new styles (in the same files) especially for scrollbar and sidebar.
    
    Modify and make more accessible an HTML structure for twig base
    template and twig homepage. Also change and optimise Bootstrap
    classes for the elements on the page.
    
    Turn on jQuery support in the webpack config file and make jQuery
    global inside assets.

[33mcommit d1c97eb50b5b2a3e6169a3622606cb36eeb36253[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Mon Sep 23 10:19:59 2019 +0200

    Create horizontal navbar and modify the code

[33mcommit 3673e7e32f001d51528f84aeb866bb6428d5d4c4[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Sat Sep 21 15:33:36 2019 +0200

    Finish creating a vertical navbar
    
    Add an user account image (for now to public images directory). Create
    an account section inside the navbar and make dropdown for it. Also
    make dropdown with subpages for Flashcard and Test (navigation items).
    
    Add custom styles for content, footer and vertical navbar and modify
    some styles but it's not refactoring yet. Make a code a little bit more
    accessible writing WAI-ARIA stuff.

[33mcommit 48d58fdd24d0c1af66862198084075d9a0995552[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Fri Sep 20 10:36:20 2019 +0200

    Add navigation components and footer section
    
    Correct HTML structure inside vertical navigation for brand and links
    section. Add buttons for serve future flashcards. Modify size of
    content and navigation container, fonts, icons and refactor their code.
    
    Create footer section and footer's components. Write some custom styles
    so that fit it to already existing elements (navigation, content).
    
    At the end refactor the code where it's needed and remove useless stuff
    from the FlashcardsController.

[33mcommit c5071c64d7484e7ac38d0e7557ac800612806339[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Thu Sep 19 15:13:42 2019 +0200

    Install Webpack with packages and create mainpage
    
    Install Webpack Encore and configure it to work with Symfony app.
    Move css and js directories from public to assets
    
    Download Bootstrap, jQuery and Font Awesome packages. Change .css
    extensions to .scss and create custom files such as _variables.scss,
    _content.scss, _vertical_navbar.scss to override some Bootstrap
    default styles.
    
    Create FlashcardController to serve mainpage and main.html.twig view
    template. Refact base.html.twig file and start creating a
    vertical navbar and content section. Add in them random content and
    fonts to the test.

[33mcommit 3ff97c84a9df3297796873e8768e7e6848b7a639[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Mon Sep 16 16:04:36 2019 +0200

    Fix a .gitignore file

[33mcommit 8edbf216f78048a761cb1b1e186e3ef25bae0a3a[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Mon Sep 16 16:00:11 2019 +0200

    Update a .gitignore file

[33mcommit 2af7a86763ba9819b98136795bc276c932db93e2[m
Author: BartTux <bartpot98@tutanota.com>
Date:   Mon Sep 16 15:18:52 2019 +0200

    Install and configure Symfony project files
