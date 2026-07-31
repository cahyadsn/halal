/**
 * Web-based Halal Food Guide - Core Client Logic
 * 
 * Version: 2.0.0
 * Author: Cahya DSN (cahyadsn@gmail.com)
 * Date: 2026-07-31
 * 
 * Description:
 * Native Vanilla ES6 implementation replacing legacy jQuery and ClueTip dependencies.
 * Handles row styling, search redirection, and tooltip display.
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Zebra Striping: apply alternating background colors to result rows
    const rows = document.querySelectorAll('div.clear');
    rows.forEach((row, index) => {
        if (index % 2 === 0) {
            const iname = row.querySelector('.iname');
            const stat = row.querySelector('.stat');
            if (iname) {
                iname.style.backgroundColor = '#dae6f4';
            }
            if (stat) {
                stat.style.backgroundColor = '#dae6f4';
            }
        }
    });

    // 2. Status Color coding: color text of ingredient rows depending on their status
    const statuses = document.querySelectorAll('.stat');
    statuses.forEach(stat => {
        const title = stat.getAttribute('title');
        const parent = stat.closest('.clear');
        if (!parent) {
            return;
        }

        switch (title) {
            case 'Haram':
                parent.style.color = 'red';
                break;
            case 'Depends':
                parent.style.color = 'blue';
                break;
            case 'Mushbooh':
                parent.style.color = 'orange';
                break;
            default:
                break;
        }
    });

    // 3. Custom Tooltip Implementation replacing jQuery ClueTip
    const tooltip = document.createElement('div');
    tooltip.className = 'custom-tooltip';
    document.body.appendChild(tooltip);

    const ingredientNames = document.querySelectorAll('div.iname');
    ingredientNames.forEach(iname => {
        iname.style.cursor = 'pointer';

        // Show tooltip on hover
        iname.addEventListener('mouseover', () => {
            const rel = iname.getAttribute('rel');
            if (!rel) {
                return;
            }
            const targetDesc = document.querySelector(rel);
            if (targetDesc) {
                tooltip.innerHTML = targetDesc.innerHTML;
                tooltip.style.display = 'block';
            }
        });

        // Position tooltip dynamically with cursor movement
        iname.addEventListener('mousemove', (e) => {
            const tooltipWidth = tooltip.offsetWidth;
            const tooltipHeight = tooltip.offsetHeight;
            let left = e.pageX + 15;
            let top = e.pageY + 15;

            // Prevent tooltip from overflowing the viewport bounds
            if (left + tooltipWidth > window.innerWidth + window.scrollX) {
                left = e.pageX - tooltipWidth - 15;
            }
            if (top + tooltipHeight > window.innerHeight + window.scrollY) {
                top = e.pageY - tooltipHeight - 15;
            }

            tooltip.style.left = `${left}px`;
            tooltip.style.top = `${top}px`;
        });

        // Hide tooltip when leaving the element
        iname.addEventListener('mouseout', () => {
            tooltip.style.display = 'none';
        });
    });

    // 4. Search Handler for the 'Go' button
    const goBtn = document.getElementById('go');
    if (goBtn) {
        goBtn.addEventListener('click', () => {
            const stext = document.getElementById('stext').value;
            const stype = document.getElementById('stype').value;
            window.location = `index.php?q=${encodeURIComponent(stext)}&s=${encodeURIComponent(stype)}`;
        });
    }
});
