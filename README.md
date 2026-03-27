# ⚡ LightStrikes

Un plugin visual para **PocketMine-MP (API 2.0.0)** que invoca un **rayo** automáticamente cuando los jugadores mueren, se conectan o desconectan del servidor. Ideal para añadir dramatismo a eventos importantes en servidores PvP, Factions o Survival sin afectar el rendimiento.

---

### ⚡ Función
*   **Rayo Personalizado:** Genera un efecto de rayo (Entidad ID 93) exactamente en la posición del jugador.
*   **3 Eventos Activables:**
    *   **Muerte:** Cae un rayo al morir (`Death`).
    *   **Entrada:** Cae un rayo al unirse al servidor (`Join`), con un ligero retraso para asegurar la carga del chunk.
    *   **Salida:** Cae un rayo al desconectarse (`Left`).
*   **Configuración Individual:** Activa o desactiva cada tipo de rayo por separado desde el archivo de configuración.
*   **Broadcast Global:** El efecto es visible para todos los jugadores en el mismo mundo donde ocurre el evento.

---

### ⚙️ Configuración Rápida
Edita el `config.yml` para activar o desactivar las funciones:
*   `Death.activado`: `true` para rayo al morir, `false` para desactivar.
*   `Join.activado`: `true` para rayo al entrar, `false` para desactivar.
*   `Left.activado`: `true` para rayo al salir, `false` para desactivar.

> **Autor:** iTzDarkoPvP  
> **Versión:** 1.0.1  
> **Requisito:** Ninguno (funciona nativo). ¡Solo instala y reinicia!
