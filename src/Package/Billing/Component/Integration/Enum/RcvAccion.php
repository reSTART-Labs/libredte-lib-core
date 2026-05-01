<?php

declare(strict_types=1);

/**
 * LibreDTE: Biblioteca PHP (Núcleo).
 * Copyright (C) LibreDTE <https://www.libredte.cl>
 *
 * Este programa es software libre: usted puede redistribuirlo y/o modificarlo
 * bajo los términos de la Licencia Pública General Affero de GNU publicada por
 * la Fundación para el Software Libre, ya sea la versión 3 de la Licencia, o
 * (a su elección) cualquier versión posterior de la misma.
 *
 * Este programa se distribuye con la esperanza de que sea útil, pero SIN
 * GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o de APTITUD
 * PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de la Licencia Pública
 * General Affero de GNU para obtener una información más detallada.
 *
 * Debería haber recibido una copia de la Licencia Pública General Affero de
 * GNU junto a este programa.
 *
 * En caso contrario, consulte <http://www.gnu.org/licenses/agpl.html>.
 */

namespace libredte\lib\Core\Package\Billing\Component\Integration\Enum;

/**
 * Acción del receptor sobre un DTE en el RCV del SII.
 *
 * Estos son los códigos que el receptor registra vía
 * `ingresarAceptacionReclamoDoc` y que el SII retorna en
 * `listarEventosHistDoc` como campo `codigo`.
 */
enum RcvAccion: string
{
    /**
     * Entrega Real de Mercaderías o Servicios.
     * Activa la cesibilidad del documento (Ley 19.983).
     */
    case ERM = 'ERM';

    /**
     * Acepta Contenido del Documento.
     */
    case ACD = 'ACD';

    /**
     * Reclamo al Contenido del Documento.
     */
    case RCD = 'RCD';

    /**
     * Reclamo por Falta Parcial de Mercaderías.
     */
    case RFP = 'RFP';

    /**
     * Reclamo por Falta Total de Mercaderías.
     */
    case RFT = 'RFT';

    public function label(): string
    {
        return match ($this) {
            self::ERM => 'Entrega Real de Mercaderías o Servicios (Ley 19.983)',
            self::ACD => 'Acepta Contenido del Documento',
            self::RCD => 'Reclamo al Contenido del Documento',
            self::RFP => 'Reclamo por Falta Parcial de Mercaderías',
            self::RFT => 'Reclamo por Falta Total de Mercaderías',
        };
    }

    public function isFavorableParaEmisor(): bool
    {
        return match ($this) {
            self::ERM, self::ACD => true,
            default              => false,
        };
    }

    public function isReclamo(): bool
    {
        return match ($this) {
            self::RCD, self::RFP, self::RFT => true,
            default                         => false,
        };
    }
}
