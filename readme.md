## CPTs, Connections & Taxa

#### Faculty

Connected to Department Template

#### Ministry

Connected to Ministry Template

#### Coaches

Connected to Sport Template

#### Players

Connected to Sport Template

#### Athletics

Athletics News Stories, Sports Taxonomy

#### News (Articles)

Custom blog posts, Uses Vanilla Cats and Tags


## Templates

#### Google Spreadsheet (Table Template)

**How To:** Create a single spreadsheet in a Google Doc. Pubish the document to the web. Move your tables 1 column over and 1 row down. Headers are read from row 2. Data in colum A and row 1 are not displayed. Copy the spreadsheet_id from the url into page.

[Example](https://docs.google.com/spreadsheets/d/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/edit?pli=1#gid=0)

    @todo optional second title and description
    @todo cache response in a transient
    @idea sub-templates for better responsive display?

#### Department

Departments are linked to faculty. You can select Faculty from the department pages, or you can select a deparment for each faculty memeber.

    @idea Faculty Pages are a template away, if we can solve the data gathering issue.

#### Ministry

Ministry is the almost the same as Department, with different connection post type.

#### Sport

A department page template that includes both Coaches and Players.

    @todo athletics news category selector

## Plugins 

#### ACF - Advanced Custom Fields

Custom Post Type and Template Meta Box editor

#### P2P - Posts 2 Posts

Define Relationships, Drag & Drop Ordering, Widget

[Shortcodes](https://github.com/scribu/wp-posts-to-posts/wiki/Shortcodes)

## Meta Boxes

Custom metaboxes setup with Advanced Custom Fields. Save files in `/nhcs/acf`

Clicking the add page button from these posts edit pages requires the user to select the correct template when creating a page (then save it).

    @todo Find elusive on template change hook. (JavaScript?)

