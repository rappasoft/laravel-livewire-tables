---
title: Polling to refresh
weight: 3
---

If you would like the component to refresh at an interval you can set the `$refresh` class property:

| Property | Default | Options | Usage |
| -------- | ------- | ------- | ----- |
| $refresh | false | false/int/string | Whether or not to refresh the table at a certain interval. false = off, int = ms, string = functionCall (if the string is `keep-alive` it will use `wire:poll.keep-alive`, if the string is `visible` it will use `wire:poll.visible`) |
