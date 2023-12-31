function nextStep(sectionId) {
    document.getElementById(sectionId).style.display = 'none';
    const nextSectionId = (sectionId === 'antar') ? 'pesan' : sectionId;
    document.getElementById(nextSectionId).style.display = 'block';
}
