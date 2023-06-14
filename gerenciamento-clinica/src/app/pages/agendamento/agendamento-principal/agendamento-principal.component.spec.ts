import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AgendamentoPrincipalComponent } from './agendamento-principal.component';

describe('AgendamentoPrincipalComponent', () => {
  let component: AgendamentoPrincipalComponent;
  let fixture: ComponentFixture<AgendamentoPrincipalComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AgendamentoPrincipalComponent]
    });
    fixture = TestBed.createComponent(AgendamentoPrincipalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
