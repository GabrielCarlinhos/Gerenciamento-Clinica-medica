import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PacientesPrincipalComponent } from './pacientes-principal.component';

describe('PacientesPrincipalComponent', () => {
  let component: PacientesPrincipalComponent;
  let fixture: ComponentFixture<PacientesPrincipalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [PacientesPrincipalComponent]
    });
    fixture = TestBed.createComponent(PacientesPrincipalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
