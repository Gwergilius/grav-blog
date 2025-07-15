---
title: Főoldal
slug: fooldal
body_classes: title-center title-h1h2
---

# Üdvözöl a Grav!
## a telepítés sikeres volt...

Gratulálunk! Telepítetted a **Grav alap csomagot**, amely biztosít egy **egyszerű oldalt** és az alapértelmezett **Quark** témát a kezdéshez.

!! Ha **404 hibát** látsz, amikor a menüben a `Typography` linkre kattintasz, kérjük, tekintsd meg a [hibaelhárítási útmutatót](http://learn.getgrav.org/troubleshooting/page-not-found).

### Tudj meg mindent a Grav-ről

* Ismerkedj meg a **Grav**-vel a dedikált [Learn Grav](http://learn.getgrav.org) oldalunkon.
* Tölts le **bővítményeket**, **témákat**, valamint egyéb Grav **skeleton** csomagokat a [Grav Downloads](http://getgrav.org/downloads) oldalról.
* Nézd meg a [Grav Development Blog](http://getgrav.org/blog) oldalt, hogy megtudd a legfrissebb híreket a Grav világából.

!!! Ha egy **teljesebb funkcionalitású** alap telepítést szeretnél, érdemes megnézned a [letöltések között elérhető **Skeleton** csomagokat](http://getgrav.org/downloads).

### Szerkeszd ezt az oldalt

Az oldal szerkesztéséhez egyszerűen navigálj abba a mappába, ahová a **Grav**-et telepítetted, majd böngészd a `user/pages/01.home` mappát és nyisd meg a `default.md` fájlt a [választott szerkesztődben](http://learn.getgrav.org/basics/requirements). Látni fogod ennek az oldalnak a tartalmát [Markdown formátumban](http://learn.getgrav.org/content/markdown).

### Hozz létre egy új oldalt

Új oldal létrehozása egyszerű dolog a **Grav**-ben. Egyszerűen kövesd ezeket az egyszerű lépéseket:

1. Navigálj az oldalak mappájába: `user/pages/` és hozz létre egy új mappát. Ebben a példában az [explicit alapértelmezett sorrendet](http://learn.getgrav.org/content/content-pages) fogjuk használni és a mappát `03.mypage`-nek nevezzük.
2. Indítsd el a szövegszerkesztődet és illeszd be a következő mintakódot:

        ---
        title: Az én új oldalam
        ---
        # Az én új oldalam!

        Ez az **új oldalam** törzse, és itt könnyedén használhatom a _Markdown_ szintaxist.

3. Mentsd el ezt a fájlt a `user/pages/03.mypage/` mappába `default.md` néven. Ez megmondja a **Grav**-nek, hogy az oldalt az **alapértelmezett** sablonnal renderje.
4. Ennyi! Frissítsd a böngésződet, hogy lásd az új oldalt a menüben.

! MEGJEGYZÉS: Az oldal automatikusan megjelenik a menüben a "Typography" menüelem után. Ha szeretnéd megváltoztatni a menüben megjelenő nevet, egyszerűen add hozzá: `menu: Az én oldalam` a kötőjelek között az oldal tartalmában. Ezt YAML front matter-nek hívják, és itt konfigurálhatod az oldal-specifikus beállításokat.
