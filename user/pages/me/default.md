---
title: 'Profil információk'
slug: me
cache_enable: false
twig_first: true
process:
  twig: true
  markdown: true
---

# 👤 Profil információk

{% set is_authenticated = grav.user.authenticated %}
{% set username = is_authenticated ? grav.user.username : 'Anonymous' %}
{% set fullname = is_authenticated ? (grav.user.fullname ? grav.user.fullname : grav.user.username) : 'Anonymous' %}
{% set email = is_authenticated ? (grav.user.email ? grav.user.email : 'n/a') : 'n/a' %}

## Alapadatok

| Mező | Érték |
|------|-------|
| **Felhasználónév** | `{{ username }}` |
| **Teljes név** | {{ fullname }} |
| **Email** | {{ email }} |
| **Bejelentkezési állapot** | {% if is_authenticated %}✅ **Bejelentkezve**{% else %}❌ **Anonim látogató**{% endif %} |

## Jogosultsági szint
{% if grav.user.authorize('admin.super') %}
🔴 **Adminisztrátor** - Teljes körű rendszerkezelés és jogosultságok
{% elseif grav.user.authorize('admin.login') and grav.user.authorize('comments.moderate') %}
🟡🟠 **Moderátor + Szerkesztő** - Tartalom szerkesztés és közösség moderálás
{% elseif grav.user.authorize('admin.login') %}
🟠 **Szerkesztő** - Cikkek szerkesztése és admin panel hozzáférés
{% elseif grav.user.authorize('comments.moderate') %}
🟡 **Moderátor** - Közösség moderálás és komment kezelés
{% elseif grav.user.authorize('site.login') %}
🔵 **Látogató** - Bejelentkezett felhasználó, kommentezhet
{% else %}
⚪ **Vendég** - Csak olvasási jogosultság{% if not is_authenticated %}, bejelentkezéssel több lehetőség{% endif %}
{% endif %}

## Fiók állapot
{% if grav.user.authorized %}
✅ **Jogosult** - Teljes hozzáférés
{% elseif grav.user.authenticated %}
⚠️ **Hitelesített** - Bejelentkezett, de korlátozott jogosultságok
{% else %}
👤 **Anonim látogató** - Csak olvasási jogosultság
{% endif %}

{% if is_authenticated %}
## Csoporttagság

| Csoport | Jelölés |
|---------|---------|
{% if grav.user.groups %}
{% for group in grav.user.groups %}
| **{{ group }}** | {% if group == 'administrators' %}🔴 Admin{% elseif group == 'editors' %}🟠 Szerkesztő{% elseif group == 'moderators' %}🟡 Moderátor{% elseif group == 'visitors' %}🔵 Látogató{% else %}⚫ Egyéb{% endif %} |
{% endfor %}
{% else %}
| _Nincs csoporttagság_ | - |
{% endif %}

## OAuth/Bejelentkezési információk

| Információ | Érték |
|------------|-------|
{% if grav.user.provider %}
| **Provider** | {{ grav.user.provider|title }} {% if grav.user.provider == 'github' %}🐙 GitHub{% elseif grav.user.provider == 'azure' %}🟦 Azure Entra ID{% elseif grav.user.provider == 'google' %}🔴 Google{% endif %} |
{% endif %}
{% if grav.user.created_via_oauth %}
| **Fiók típus** | OAuth2 automatikusan létrehozott fiók |
{% endif %}
{% if grav.user.first_login %}
| **Első bejelentkezés** | {{ grav.user.first_login }} |
{% endif %}
{% if grav.user.last_oauth_login %}
| **Utolsó OAuth bejelentkezés** | {{ grav.user.last_oauth_login }} |
{% endif %}
{% if not grav.user.provider and not grav.user.created_via_oauth %}
| _Nincs OAuth információ_ | Hagyományos fiók vagy nincs adat |
{% endif %}
{% else %}
## Bejelentkezési lehetőségek

| Szolgáltatás | Leírás |
|--------------|--------|
| 💬 **Kommentálás** | Hozzászólás a cikkekhez |
| 👥 **Közösségi funkciók** | Személyre szabott tartalom |
| ⚙️ **Admin funkciók** | Ha megfelelő jogosultságaid vannak |

### Elérhető bejelentkezési módok

| Provider | Link |
|----------|------|
| 🐙 GitHub | [Bejelentkezés GitHub-bal](/login) |
| 🟦 Azure Entra ID | [Bejelentkezés Azure-ral](/login) |
| 🔴 Google | [Bejelentkezés Google-lel](/login) |
{% endif %}

## Részletes jogosultságok

### Oldal jogosultságok

| Funkció | Állapot | Megjegyzés |
|---------|---------|------------|
| **Cikkek olvasása** | ✅ Engedélyezett | Mindenki számára |
| **Bejelentkezés** | {% if grav.user.authorize('site.login') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('site.login') %}Bejelentkezés szükséges{% else %}-{% endif %} |
| **Kommentálás** | {% if grav.user.authorize('comments.create') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('comments.create') %}Bejelentkezés szükséges{% else %}-{% endif %} |
| **Komment moderálás** | {% if grav.user.authorize('comments.moderate') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('comments.moderate') %}Moderátori jogosultság szükséges{% else %}-{% endif %} |
| **Felhasználó moderálás** | {% if grav.user.authorize('users.moderate') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('users.moderate') %}Moderátori jogosultság szükséges{% else %}-{% endif %} |

### Admin jogosultságok

| Funkció | Állapot | Megjegyzés |
|---------|---------|------------|
| **Admin panel hozzáférés** | {% if grav.user.authorize('admin.login') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('admin.login') %}Szerkesztői jogosultság szükséges{% else %}-{% endif %} |
| **Oldalak kezelése** | {% if grav.user.authorize('admin.pages') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('admin.pages') %}Szerkesztői jogosultság szükséges{% else %}-{% endif %} |
| **Felhasználók kezelése** | {% if grav.user.authorize('admin.users') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('admin.users') %}Adminisztrátori jogosultság szükséges{% else %}-{% endif %} |
| **Teljes adminisztráció** | {% if grav.user.authorize('admin.super') %}✅ Engedélyezett{% else %}❌ Tiltott{% endif %} | {% if not is_authenticated and not grav.user.authorize('admin.super') %}Adminisztrátori jogosultság szükséges{% else %}-{% endif %} |

## Session információk

| Információ | Érték |
|------------|-------|
{% if is_authenticated %}
| **Session ID** | `{{ grav.session.getId() }}` |
{% endif %}
| **Aktuális időpont** | {{ "now"|date("Y-m-d H:i:s") }} |
| **IP cím** | {{ grav.request.server.get('REMOTE_ADDR')|default(grav.request.server.get('HTTP_X_FORWARDED_FOR'))|default(grav.request.server.get('HTTP_CLIENT_IP'))|default('Nem elérhető') }} |

---

### Műveletek

| Művelet | Link |
|---------|------|
{% if is_authenticated %}
| 🔓 **Kijelentkezés** | [Kijelentkezés]({{ grav.uri.rootUrl }}/login/task:login.logout) |
{% if grav.user.authorize('admin.login') %}
| ⚙️ **Admin panel** | [Admin felület](/admin) |
{% endif %}
{% else %}
| 🔐 **Bejelentkezés** | [Bejelentkezés](/login) |
{% endif %}
| 🏠 **Főoldal** | [Kezdőlap](/) |

{% if not is_authenticated %}

### 💡 Mit kapsz a bejelentkezéssel?

| Előny | Leírás |
|-------|--------|
| **Kommentálási lehetőség** | Részt vehetsz a beszélgetésekben |
| **Személyre szabott tartalom** | A rendszer megjegyzi preferenciáidat |
| **Közösségi funkciók** | Kapcsolódás más felhasználókkal |
| **Admin jogosultságok** | Ha megfelelő jogosultságaid vannak |

<a href="/login" style="display: inline-block; background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 10px;">🚀 Bejelentkezés most</a>

{% endif %}