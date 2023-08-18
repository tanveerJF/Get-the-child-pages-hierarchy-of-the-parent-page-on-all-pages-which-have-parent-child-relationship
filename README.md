# Get-the-child-pages-hierarchy-of-the-parent-page-on-all-pages-which-have-parent-child-relationship
# Recursive Child Page Navigation
A WordPress code snippet to display child page navigation recursively for the current page.
## Description
This code will display a sidebar navigation of all child pages for the current page in a nested hierarchical structure.
It works by:
- Getting the current page ID and top-level parent page ID.
- Checking if the current page or any child pages have their own child pages.
- If child pages exist, the recursive function is called to display all nested child pages.
- The child pages are output with appropriate WordPress looping and formatting.
This provides an easy way to show a nested sidebar navigation of all child pages on a site.
## Usage
- Copy the PHP code into your WordPress theme, such as in sidebar.php.
- Adjust markup and styling as needed.
- The recursive function will output the nested child page links automatically.
- Works for any number of child page levels.
## Installation
1. Copy the PHP code snippet into your WordPress theme file (e.g. sidebar.php).
2. Include a <div> with the side-nav class to contain the navigation markup.
3. Adjust the styling and markup as needed to fit your theme.
And that's it! The child page navigation will now appear on pages that have child pages.
## Credits
Recursive child page navigation code written by Tanveer Ahmed Jafri.
