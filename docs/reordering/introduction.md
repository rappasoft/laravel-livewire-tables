---
title: Introduction
weight: 1
---

The previous iteration utilised third-party Sortable plugins, which are not required for Version 3.x, and are not supported in Livewire 3.x at the time of writing.

## An update about reordering

If you have a large data set to sort, then it is recommended that you create a minimal table instance with only the required columns for performance reasons.

The field keys used in the reorder() function have been updated, and allow for easier upserting/reuse of reorder code.

The reorder will not be saved until you click the "Save" button.
