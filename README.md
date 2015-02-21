![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# ChestLocker

Chest Locker plugin for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.4 API 1.8.0

## Overview

**ChestLocker** allows players to lock/unlock their chests.

**EvolSoft Website:** http://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

Players can simply lock/unlock their chest using commands "/lockchest" and "/unlockchest".

**Commands:**

***/chestlocker*** *- ChestLocker commands*<br>
***/lockchest*** *- Lock a Chest*<br>
***/unlockchest*** *- Unlock a Chest*

**To-Do:**

<dd><i>- Bug fix (if bugs will be found)</i></dd>
<dd><i>- Large Chest protection</i></dd>
<dd><i>- Possibly MySQL support</i></dd>

## FAQ

**How to lock/unlock a chest?**
<br>
Do "/lockchest" or "/unlockchest" then click the chest you want to lock/unlock

## Documentation 

**Configuration (config.yml):**
```yaml
---
#Protect locked chests from destroying (It can be bypassed with the permission: chestlocker.bypass)
protect-chests: true
...
```

**Commands:**

***/chestlocker*** *- ChestLocker commands (aliases: [chlock, chl, chestlock, cl])*<br>
***/lockchest*** *- Lock a Chest*<br>
***/unlockchest*** *- Unlock a Chest*<br>

**Permissions:**

- <dd><i><b>chestlocker.*</b> - ChestLocker permissions.</i></dd>
- <dd><i><b>chestlocker.bypass</b> - Bypass chest lock.</i></dd>
- <dd><i><b>chestlocker.commands.*</b> - ChestLocker commands permissions.</i></dd>
- <dd><i><b>chestlocker.commands.help</b> - ChestLocker command Help permission.</i></dd>
- <dd><i><b>chestlocker.commands.info</b> - ChestLocker command Info permission.</i></dd>
- <dd><i><b>chestlocker.commands.lockchest</b> - ChestLocker command LockChest permission.</i></dd>
- <dd><i><b>chestlocker.commands.unlockchest</b> - ChestLocker command UnlockChest permission.</i></dd>
